<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class FileUploadService
{
    /**
     * Upload a single file to storage
     *
     * @param UploadedFile $file
     * @param string $directory
     * @param string|null $filename
     * @return string|false Path to uploaded file or false on failure
     */
    public function uploadFile(UploadedFile $file, string $directory = 'img', ?string $filename = null): string|false
    {
        try {
            $filename = $filename ?? Str::uuid() . '.' . $file->getClientOriginalExtension();
            
            // Use public_path instead of storage for direct access
            $destinationPath = public_path('storage/' . $directory);
            
            // Create directory if it doesn't exist
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            // Move file to public/storage directory
            $file->move($destinationPath, $filename);
            
            return $filename;
        } catch (\Exception $e) {
            Log::error('File upload failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Upload multiple files to storage
     *
     * @param array $files
     * @param string $directory
     * @return array Array of uploaded filenames
     */
    public function uploadMultipleFiles(array $files, string $directory = 'img'): array
    {
        $uploadedFiles = [];
        
        foreach ($files as $file) {
            if ($file instanceof UploadedFile) {
                $filename = $this->uploadFile($file, $directory);
                if ($filename) {
                    $uploadedFiles[] = $filename;
                }
            }
        }
        
        return $uploadedFiles;
    }

    /**
     * Delete a file from storage
     *
     * @param string $path
     * @return bool
     */
    public function deleteFile(string $path): bool
    {
        try {
            // Delete from public/storage directory
            $filePath = public_path('storage/' . $path);
            
            if (file_exists($filePath)) {
                return unlink($filePath);
            }
            return true; // File doesn't exist, consider it deleted
        } catch (\Exception $e) {
            Log::error('File deletion failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Delete multiple files from storage
     *
     * @param array $paths
     * @return int Number of files successfully deleted
     */
    public function deleteMultipleFiles(array $paths): int
    {
        $deletedCount = 0;
        
        foreach ($paths as $path) {
            if ($this->deleteFile($path)) {
                $deletedCount++;
            }
        }
        
        return $deletedCount;
    }

    /**
     * Replace an existing file with a new one
     *
     * @param UploadedFile $newFile
     * @param string|null $oldFilePath
     * @param string $directory
     * @return string|false New filename or false on failure
     */
    public function replaceFile(UploadedFile $newFile, ?string $oldFilePath, string $directory = 'img'): string|false
    {
        // Delete old file if exists
        if ($oldFilePath) {
            $this->deleteFile($oldFilePath);
        }
        
        // Upload new file
        return $this->uploadFile($newFile, $directory);
    }

    /**
     * Validate image file
     *
     * @param UploadedFile $file
     * @param int $maxSize Maximum size in KB (default 2048 = 2MB)
     * @param array $allowedMimes
     * @return array ['valid' => bool, 'error' => string|null]
     */
    public function validateImage(
        UploadedFile $file,
        int $maxSize = 2048,
        array $allowedMimes = ['jpeg', 'png', 'jpg']
    ): array {
        // Check if file is an image
        if (!$file->isValid()) {
            return ['valid' => false, 'error' => 'Invalid file'];
        }

        // Check mime type
        $extension = $file->getClientOriginalExtension();
        if (!in_array(strtolower($extension), $allowedMimes)) {
            return ['valid' => false, 'error' => 'File must be ' . implode(', ', $allowedMimes)];
        }

        // Check file size
        if ($file->getSize() > $maxSize * 1024) {
            return ['valid' => false, 'error' => "File size cannot exceed {$maxSize}KB"];
        }

        return ['valid' => true, 'error' => null];
    }

    /**
     * Get file URL from storage path
     *
     * @param string $path
     * @return string
     */
    public function getFileUrl(string $path): string
    {
        return Storage::url($path);
    }
}
