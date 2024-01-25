<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateAttributeRequest;
use App\Http\Requests\Admin\UpdateAttributeRequest;
use App\Models\Attribute;
use Illuminate\Database\QueryException;

class AttributeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $attributes = Attribute::paginate(10);

        return view('admin.attributes.index', [
            'attributes' => $attributes
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.attributes.create');
    }

    /**
     * @param CreateAttributeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateAttributeRequest $request)
    {
        $input = $request->all();

        $attr = Attribute::create($input);

        return redirect()->route('admin.attributes.edit', [
            'id' => $attr->id
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit($id)
    {
        $attribute = Attribute::find($id);

        if (empty($attribute)) {
            return redirect(route('admin.attributes.index'));
        }

        return view('admin.attributes.edit', [
            'attribute' => $attribute,
        ]);
    }

    /**
     * @param UpdateAttributeRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateAttributeRequest $request, $id)
    {
        $attribute = Attribute::find($id);

        if (!$attribute) {
            dd(404);
        }

        $input = $request->all();

        $attribute->update($input);

        return redirect()->back();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        try {
            $attribute = Attribute::findOrFail($id);
            $attribute->delete();

            return redirect()->route('admin.attributes.index');
        } catch (\Exception $e) {
            if ($e instanceof QueryException && $e->errorInfo[1] == 1451) {
                // Foreign key constraint violation
                return redirect()->route('admin.attributes.index')
                    ->with('error', 'Cannot delete the attribute. It is associated with other records.');
            }

            // Handle other types of exceptions or rethrow the exception
            dd($e);
        }
    }
}
