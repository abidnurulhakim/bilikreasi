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
        Form::component('formTags', 'components.form.form-tags', ['name', 'collection', 'value', 'attributes']);
        Form::component('formTextArea', 'components.form.form-text-area', ['name', 'value', 'attributes']);
        Form::component('formSelect', 'components.form.form-select', ['name', 'collection', 'value', 'attributes']);
        Form::component('formTextEditor', 'components.form.form-text-editor', ['name', 'value', 'attributes']);
        Form::component('file', 'components.form.form-date', ['name', 'value', 'attributes']);
        Form::component('date', 'components.form.date', ['name', 'value', 'attributes']);
        Form::component('birthDate', 'components.form.birthdate', ['name', 'value', 'attributes']);
        Form::component('dateTime', 'components.form.datetime', ['name', 'value', 'attributes']);
        Form::component('textArea', 'components.form.text-area', ['name', 'value', 'attributes']);
        Form::component('textEditor', 'components.form.text-editor', ['name', 'value', 'attributes']);
        Form::component('formDateTimeLink', 'components.form.form-datetime-link', ['nameStart', 'nameFinish', 'valueStart', 'valueFinish', 'attributes']);

        /*Materialize form*/
        Form::component('formMaterializeText', 'components.form.materialize.form-text', ['name', 'value', 'attributes']);
        Form::component('formMaterializeNumber', 'components.form.materialize.form-number', ['name', 'value', 'attributes']);
        Form::component('formMaterializePassword', 'components.form.materialize.form-password', ['name', 'attributes']);
        Form::component('formMaterializeSearch', 'components.form.materialize.form-search', ['name', 'value', 'attributes']);
        Form::component('formMaterializeRadio', 'components.form.materialize.form-radio', ['name', 'value', 'attributes']);
        Form::component('formMaterializeCheckbox', 'components.form.materialize.form-checkbox', ['name', 'value', 'attributes']);
        Form::component('formMaterializeEmail', 'components.form.materialize.form-email', ['name', 'value', 'attributes']);
        Form::component('formMaterializeDate', 'components.form.materialize.form-date', ['name', 'value', 'attributes']);
        Form::component('formMaterializeBirthDate', 'components.materialize.form.form-date', ['name', 'value', 'attributes']);
        Form::component('formMaterializeDateTime', 'components.materialize.form.form-datetime', ['name', 'value', 'attributes']);
        Form::component('formMaterializeFile', 'components.form.materialize.form-file', ['name', 'value', 'attributes']);
        Form::component('formMaterializeTags', 'components.form.materialize.form-tags', ['name', 'collection', 'value', 'attributes']);
        Form::component('formMaterializeTextArea', 'components.materialize.form.form-text-area', ['name', 'value', 'attributes']);
        Form::component('formMaterializeSelect', 'components.form.materialize.form-select', ['name', 'collection', 'value', 'attributes']);
        Form::component('formMaterializeTextEditor', 'components.form.materialize.form-text-editor', ['name', 'value', 'attributes']);
        Form::component('materializeFile', 'components.form.materialize.form-date', ['name', 'value', 'attributes']);
        Form::component('materializeDate', 'components.form.materialize.date', ['name', 'value', 'attributes']);
        Form::component('materializeBirthdate', 'components.form.materialize.birthdate', ['name', 'value', 'attributes']);
        Form::component('MaterializeDateTime', 'components.form.materialize.datetime', ['name', 'value', 'attributes']);
        Form::component('MaterializeTextarea', 'components.form.materialize.text-area', ['name', 'value', 'attributes']);
        Form::component('MaterializeTextEditor', 'components.form.materialize.text-editor', ['name', 'value', 'attributes']);
        Form::component('formMaterializeDateTimeLink', 'components.form.materialize.form-datetime-link', ['nameStart', 'nameFinish', 'valueStart', 'valueFinish', 'attributes']);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('production')) {
            $this->app->register(\Jenssegers\Rollbar\RollbarServiceProvider::class);
        }
    }
}
