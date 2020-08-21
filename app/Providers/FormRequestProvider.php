<?php

namespace App\Providers;

use App\Concerns\FormRequest;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;
use Symfony\Component\HttpFoundation\Request;

class FormRequestProvider extends ServiceProvider
{
    use ProvidesConvenienceMethods;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->resolving(FormRequest::class, function ($request, $app) {
            $this->initializeRequest($request, $app['request']);
        });
    }
    /**
     * Initialize the form request with data from the given request.
     *
     * @param  FormRequest $form
     * @param  \Symfony\Component\HttpFoundation\Request  $current
     * @return void
     */
    protected function initializeRequest(FormRequest $form, Request $current)
    {
        $files = $current->files->all();
        $files = is_array($files) ? array_filter($files) : $files;
        $form->initialize(
            $current->query->all(), $current->request->all(), $current->attributes->all(),
            $current->cookies->all(), $files, $current->server->all(), $current->getContent()
        );

        if ($session = $current->getSession()) {
            $form->setLaravelSession($session);
        }

        $form
            ->setJson($current->json())
            ->setUserResolver($current->getUserResolver())
            ->setRouteResolver($current->getRouteResolver());

        $this->validate($form, $form->rules());
    }
}
