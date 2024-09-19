<?php

namespace App\Traits;


use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

trait ResponseController
{

    /**
     * Generate a response for storing or updating a resource.
     *
     * @param mixed $response The result of the store or update operation.
     * @param Request $request The current request instance.
     * @param string $editRoute The route name for editing the resource.
     * @param string $indexRoute The route name for listing the resources.
     * @return RedirectResponse
     */
    public function handleResponse(mixed $response, Request $request, string $editRoute, string $indexRoute): RedirectResponse
    {
        if ($response) {
            return $request->input('submitter') == 'save'
                ? to_route($editRoute, $response->id)->with('success', __('notifySuccess'))
                : to_route($indexRoute)->with('success', __('notifySuccess'));
        }

        return back()->with('error', __('notifyFail'))->withInput();
    }

    /**
     * Generate a response for updating a resource.
     *
     * @param mixed $response The result of the update operation.
     * @return RedirectResponse
     */
    public function handleUpdateResponse(mixed $response): RedirectResponse
    {
        if ($response) {
            return back()->with('success', __('notifySuccess'));
        }

        return back()->with('error', __('notifyFail'))->withInput();
    }
}
