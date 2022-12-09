<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShowPersonRequest;
use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Models\Person;

class PersonController extends Controller
{
    public function show(ShowPersonRequest $request)
    {
        $person = Person::find($request->validated('person'));

        return view('show', $person);
    }

    public function store(StorePersonRequest $request)
    {
        $person = new Person();
        $person->first_name = $request->validated('first_name');
        $person->last_name = $request->validated('last_name');
        $person->middle_name = $request->validated('middle_name');
        $person->save();

        return redirect(route('persons.show', ['person' => $person->id]));
    }

    public function update(UpdatePersonRequest $request)
    {
        $person = Person::find($request->validated('person'));
        $person->first_name = $request->validated('first_name');
        $person->last_name = $request->validated('last_name');
        $person->middle_name = $request->validated('middle_name');
        $person->save();

        return \response()->json(['data' => [
            'first_name' => $person->first_name,
            'last_name' => $person->last_name,
            'middle_name' => $person->middle_name,
        ]]);
    }
}
