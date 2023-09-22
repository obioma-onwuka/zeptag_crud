<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Repositories\CompanyRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class ContactController extends Controller
{

    public function __construct(protected CompanyRepository $company){

    }

    public function index(CompanyRepository $company, Request $request){


        $companies = $this->company->pluck();
    
        
        $contactsCollection = Contact::allowedTrash()
            ->allowedSorts(['first_name', 'last_name', 'email'], "-id")
            ->allowedFilters('company_id')
            ->allowedSearch('first_name', 'last_name', 'email')->get();


        $perPage = 10;
        $currentPage = request()->query('page', 1);
        $items = $contactsCollection->slice(($currentPage * $perPage) - $perPage, $perPage); 
        $total = $contactsCollection->count();

        $contacts = new LengthAwarePaginator($items, $total, $perPage, $currentPage, [

            'path' => request()->url(),
            'query' => request()->query()

        ]);

       
    
        return view('contacts.index', compact('contacts', 'companies'));


    }


    public function create(){

        $companies = $this->company->pluck();
        $contact = new Contact();

        return view('contacts.create', compact('companies', 'contact'));
        
    }

    public function show(Contact $contact){

        return view('contacts.show')->with('contact', $contact);

    }

    public function store(Request $request){

        $formData = $request->validate($this->rules());
        
        Contact::create($formData);

        return back()->with('success', 'Contact has been created successfully.');
        
    }

    public function edit(Contact $contact){

        $companies = $this->company->pluck();

        return view('contacts.edit', compact('companies', 'contact'));

    }

    public function update(Contact $contact, Request $request){

        $formData = $request->validate($this->rules());

        $formData['first_name'] = strip_tags($formData['first_name']);
        $formData['last_name'] = strip_tags($formData['last_name']);
        $formData['email'] = strip_tags($formData['email']);
        $formData['phone'] = strip_tags($formData['phone']);
        $formData['address'] = strip_tags($formData['address']);
        $formData['company_id'] = strip_tags($formData['company_id']);

        $storeData = $contact->update($formData);
        if ($storeData){

            return redirect()->route('contacts.show', ['contact' => $contact->id])->with('success', 'Contact has been updated successfully.');

            

        }else{

            return back()->with('error', "Something went wrong, try again later.");

        }

    }

    protected function rules(){

        return [

            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email'],
            'phone' => 'nullable',
            'address' => 'nullable',
            'company_id' => ['required', 'exists:companies,id']

        ];

    }

    public function delete(Contact $contact){


        $destroyContact = $contact->delete();

        if( $destroyContact ){

            $redirect = request()->query('redirect');
        
            return ($redirect ? redirect()->route($redirect) : back())
            ->with('success', 'Contact has been moved to trash successfully.')
            ->with('undoRoute', $this->getUndoRoute('contacts.restore', $contact));

        }

    }

    public function restore(Contact $contact){


        $destroyContact = $contact->restore();

        if( $destroyContact ){
        
            return back()
            ->with('success', 'Contact has been restored from trash successfully.')
            ->with('undoRoute', $this->getUndoRoute('contacts.delete', $contact));

        }

    }

    protected function getUndoRoute($name, $resource){

        return request()->missing('undo') ? route($name, [$resource->id, 'undo' => true]) : null;

    }

    public function forceDelete(Contact $contact){


        $destroyContact = $contact->forceDelete();

        if( $destroyContact ){
        
            return back()
            ->with('success', 'Contact has been removed permanently.');

        }

    }

}
