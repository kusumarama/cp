<?php

if (!function_exists('translate_field')) {
    function translate_field($model, $field) {
        $locale = app()->getLocale();
        if ($locale === 'id') {
            $idField = $field . '_id';
            if (isset($model->$idField) && !empty($model->$idField)) {
                return $model->$idField;
            }
        }
        return $model->$field;
    }
}
