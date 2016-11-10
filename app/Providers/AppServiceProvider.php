<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Collective\Html\FormFacade as Form;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Form::component('formText', 'components.form.form-text', ['name', 'value', 'attributes']);
        Form::component('formNumber', 'components.form.form-number', ['name', 'value', 'attributes']);
        Form::component('formPassword', 'components.form.form-password', ['name', 'attributes']);
        Form::component('formSearch', 'components.form.form-search', ['name', 'value', 'attributes']);
        Form::component('formRadio', 'components.form.form-radio', ['name', 'value', 'attributes']);
        Form::component('formCheckbox', 'components.form.form-checkbox', ['name', 'value', 'attributes']);
        Form::component('formEmail', 'components.form.form-email', ['name', 'value', 'attributes']);
        Form::component('formDate', 'components.form.form-date', ['name', 'value', 'attributes']);
        Form::component('formBirthDate', 'components.form.form-date', ['name', 'value', 'attributes']);
        Form::component('formDateTime', 'components.form.form-datetime', ['name', 'value', 'attributes']);
        Form::component('formFile', 'components.form.form-file', ['name', 'value', 'attributes']);
        Form::component('formTags', 'components.form.form-tags', ['name', 'value', 'attributes']);
        Form::component('formTextArea', 'components.form.form-text-area', ['name', 'value', 'attributes']);
        Form::component('formSelect', 'components.form.form-select', ['name', 'value', 'attributes']);
        Form::component('formTextEditor', 'components.form.form-text-editor', ['name', 'value', 'attributes']);
        Form::component('file', 'components.form.form-date', ['name', 'value', 'attributes']);
        Form::component('date', 'components.form.date', ['name', 'value', 'attributes']);
        Form::component('birthDate', 'components.form.birthdate', ['name', 'value', 'attributes']);
        Form::component('dateTime', 'components.form.datetime', ['name', 'value', 'attributes']);
        Form::component('textArea', 'components.form.text-area', ['name', 'value', 'attributes']);
        Form::component('selectPicker', 'components.form.select', ['name', 'value', 'attributes']);
        Form::component('textEditor', 'components.form.text-editor', ['name', 'value', 'attributes']);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
