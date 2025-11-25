/**
 * Unified CRUD Operations JavaScript Module
 * Handles DataTables, Modals, Forms, File Uploads, and AJAX requests
 * 
 * @author PT Markat Digdaya Konstruksi
 * @version 1.0.0
 */

(function($) {
    'use strict';

    /**
     * Global Configuration
     */
    const AppConfig = {
        csrf: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
        loaderSelector: '.loader-overlay',
        defaultPageLength: 10,
        toastDuration: 3000,
        imageMaxSize: 2048, // KB
        allowedImageTypes: ['image/jpeg', 'image/png', 'image/jpg'],
    };

    /**
     * Setup AJAX with CSRF token
     */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': AppConfig.csrf
        }
    });

    /**
     * Loader Management
     */
    const Loader = {
        show() {
            $(AppConfig.loaderSelector).css('display', 'flex');
        },
        hide() {
            $(AppConfig.loaderSelector).css('display', 'none');
        }
    };

    /**
     * Toast Notifications
     */
    const Toast = {
        success(message) {
            toastr.success(message, 'Success', {
                timeOut: AppConfig.toastDuration
            });
        },
        error(message) {
            toastr.error(message, 'Error', {
                timeOut: AppConfig.toastDuration
            });
        },
        warning(message) {
            toastr.warning(message, 'Warning', {
                timeOut: AppConfig.toastDuration
            });
        },
        info(message) {
            toastr.info(message, 'Info', {
                timeOut: AppConfig.toastDuration
            });
        }
    };

    /**
     * DataTable Initialization
     */
    const DataTableManager = {
        init(tableId, config = {}) {
            const defaultConfig = {
                processing: true,
                serverSide: true,
                responsive: true,
                pageLength: AppConfig.defaultPageLength,
                lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
                language: {
                    processing: '<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>',
                    emptyTable: 'No data available',
                    zeroRecords: 'No matching records found'
                }
            };

            return $(tableId).DataTable($.extend(true, {}, defaultConfig, config));
        }
    };

    /**
     * Form Management
     */
    const FormManager = {
        /**
         * Reset form and clear validation errors
         */
        reset(formId) {
            $(formId)[0].reset();
            $(formId).find('.is-invalid').removeClass('is-invalid');
            $(formId).find('.invalid-feedback').remove();
        },

        /**
         * Display validation errors
         */
        showErrors(formId, errors) {
            this.clearErrors(formId);

            if (typeof errors === 'string') {
                Toast.error(errors);
                return;
            }

            $.each(errors, function(field, messages) {
                const input = $(`${formId} [name="${field}"]`);
                input.addClass('is-invalid');
                
                const errorMessage = Array.isArray(messages) ? messages[0] : messages;
                input.after(`<div class="invalid-feedback d-block">${errorMessage}</div>`);
            });
        },

        /**
         * Clear all validation errors
         */
        clearErrors(formId) {
            $(formId).find('.is-invalid').removeClass('is-invalid');
            $(formId).find('.invalid-feedback').remove();
        },

        /**
         * Serialize form data including files
         */
        serializeWithFiles(formId) {
            const formData = new FormData($(formId)[0]);
            return formData;
        }
    };

    /**
     * Modal Management
     */
    const ModalManager = {
        show(modalId) {
            $(modalId).modal('show');
        },
        hide(modalId) {
            $(modalId).modal('hide');
        },
        toggle(modalId) {
            $(modalId).modal('toggle');
        }
    };

    /**
     * Image Management
     */
    const ImageManager = {
        /**
         * Preview single image
         */
        preview(file, previewElementId) {
            if (file && file.type.match('image.*')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $(`#${previewElementId}`).attr('src', e.target.result).show();
                };
                reader.readAsDataURL(file);
            }
        },

        /**
         * Preview multiple images
         */
        previewMultiple(files, containerElementId) {
            const container = $(`#${containerElementId}`);
            container.empty();

            Array.from(files).forEach((file, index) => {
                if (file.type.match('image.*')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        container.append(`
                            <div class="col-md-3 mb-3 position-relative image-preview-item" data-index="${index}">
                                <img src="${e.target.result}" class="img-fluid rounded border">
                                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2 remove-preview-image" data-index="${index}">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        `);
                    };
                    reader.readAsDataURL(file);
                }
            });
        },

        /**
         * Validate image file
         */
        validate(file) {
            if (!file) {
                return { valid: false, message: 'No file selected' };
            }

            if (!AppConfig.allowedImageTypes.includes(file.type)) {
                return { valid: false, message: 'Invalid file type. Only JPEG, PNG, and JPG are allowed.' };
            }

            if (file.size > AppConfig.imageMaxSize * 1024) {
                return { valid: false, message: `File size exceeds ${AppConfig.imageMaxSize}KB` };
            }

            return { valid: true, message: null };
        },

        /**
         * Setup image zoom functionality
         */
        setupZoom(imageSelector, modalId = '#imageZoomModal') {
            $(document).on('click', imageSelector, function() {
                const imgSrc = $(this).attr('src');
                $(`${modalId} #zoomedImage`).attr('src', imgSrc);
                ModalManager.show(modalId);
            });
        }
    };

    /**
     * AJAX Request Handler
     */
    const AjaxManager = {
        /**
         * Generic AJAX request
         */
        request(config) {
            const defaultConfig = {
                type: 'GET',
                dataType: 'json',
                cache: false,
                beforeSend: function() {
                    Loader.show();
                },
                complete: function() {
                    Loader.hide();
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                    Toast.error('An error occurred. Please try again.');
                }
            };

            return $.ajax($.extend(true, {}, defaultConfig, config));
        },

        /**
         * Load data for DataTable
         */
        loadDataTable(url, table, searchValue = '') {
            return this.request({
                url: url,
                data: {
                    search: searchValue,
                    start: 0,
                    length: AppConfig.defaultPageLength
                },
                success: function(response) {
                    if (response.success !== undefined && response.success === 0) {
                        Toast.error(response.message || 'Failed to load data');
                    }
                }
            });
        }
    };

    /**
     * CRUD Operations
     */
    const CRUDManager = {
        /**
         * Create/Store record
         */
        store(url, formData, successCallback) {
            AjaxManager.request({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success === 1) {
                        Toast.success(response.message || 'Data saved successfully');
                        if (typeof successCallback === 'function') {
                            successCallback(response);
                        }
                    } else {
                        Toast.error(response.messages || 'Failed to save data');
                    }
                }
            });
        },

        /**
         * Read/Detail record
         */
        detail(url, id, successCallback) {
            AjaxManager.request({
                url: url,
                data: { id: id },
                success: function(response) {
                    if (response.success === 1) {
                        if (typeof successCallback === 'function') {
                            successCallback(response.data);
                        }
                    } else {
                        Toast.error(response.message || 'Failed to load data');
                    }
                }
            });
        },

        /**
         * Update record
         */
        update(url, formData, successCallback) {
            AjaxManager.request({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success === 1) {
                        Toast.success(response.message || 'Data updated successfully');
                        if (typeof successCallback === 'function') {
                            successCallback(response);
                        }
                    } else {
                        Toast.error(response.messages || 'Failed to update data');
                    }
                }
            });
        },

        /**
         * Delete record with confirmation
         */
        delete(url, id, successCallback) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    AjaxManager.request({
                        url: url,
                        type: 'DELETE',
                        data: { id: id },
                        success: function(response) {
                            if (response.success === 1) {
                                Swal.fire('Deleted!', response.message || 'Data has been deleted.', 'success');
                                if (typeof successCallback === 'function') {
                                    successCallback(response);
                                }
                            } else {
                                Swal.fire('Error!', response.message || 'Failed to delete data.', 'error');
                            }
                        }
                    });
                }
            });
        }
    };

    /**
     * Carousel Manager
     */
    const CarouselManager = {
        /**
         * Initialize Bootstrap carousel
         */
        init(carouselId, options = {}) {
            const defaultOptions = {
                interval: 5000,
                pause: 'hover',
                wrap: true
            };
            
            const carousel = new bootstrap.Carousel(carouselId, $.extend({}, defaultOptions, options));
            return carousel;
        },

        /**
         * Load images into carousel
         */
        loadImages(carouselId, images, altText = 'Image') {
            const carouselInner = $(`${carouselId} .carousel-inner`);
            carouselInner.empty();

            if (images && images.length > 0) {
                images.forEach((img, index) => {
                    const activeClass = index === 0 ? 'active' : '';
                    const imagePath = typeof img === 'object' ? img.image_path : img;
                    
                    carouselInner.append(`
                        <div class="carousel-item ${activeClass}">
                            <img src="/storage/${imagePath}" class="d-block w-100 zoom-image" alt="${altText}" 
                                 style="max-height: 500px; object-fit: contain; cursor: pointer;">
                        </div>
                    `);
                });
            }
        }
    };

    /**
     * Export to global scope
     */
    window.App = {
        Config: AppConfig,
        Loader: Loader,
        Toast: Toast,
        DataTable: DataTableManager,
        Form: FormManager,
        Modal: ModalManager,
        Image: ImageManager,
        Ajax: AjaxManager,
        CRUD: CRUDManager,
        Carousel: CarouselManager
    };

    /**
     * Initialize on document ready
     */
    $(document).ready(function() {
        // Setup image zoom for all modules
        App.Image.setupZoom('.zoom-image');

        // Enable Bootstrap tooltips
        $('[data-toggle="tooltip"]').tooltip();

        // Enable Bootstrap popovers
        $('[data-toggle="popover"]').popover();

        console.log('App initialized successfully');
    });

})(jQuery);
