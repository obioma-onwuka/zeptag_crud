<x-main>
    @section('title', $contact->first_name . ' ' . $contact->last_name)
    <main class="py-5">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-title">
                            <strong>Contact Details</strong>
                        </div>           
                        <div class="card-body">

                            @if($message = session('success'))

                                <div class="alert alert-success text-center">

                                    {{$message}}

                                </div>

                            @endif

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="first_name" class="col-md-3 col-form-label">First Name:</label>
                                        <div class="col-md-9">
                                            <p class="form-control-plaintext text-muted">
                                                {{$contact->first_name}}
                                            </p>
                                        </div>
                                    </div>
  
                                    <div class="form-group row">
                                        <label for="last_name" class="col-md-3 col-form-label">Last Name:</label>
                                        <div class="col-md-9">
                                            <p class="form-control-plaintext text-muted">{{$contact->last_name}}</p>
                                        </div>
                                    </div>
  
                                    <div class="form-group row">
                                        <label for="email" class="col-md-3 col-form-label">Email:</label>
                                        <div class="col-md-9">
                                            <p class="form-control-plaintext text-muted">{{$contact->email}}</p>
                                        </div>
                                    </div>
  
                                    <div class="form-group row">
                                        <label for="phone" class="col-md-3 col-form-label">Phone:</label>
                                        <div class="col-md-9">
                                            <p class="form-control-plaintext text-muted">
                                                {{$contact->phone}}
                                            </p>
                                        </div>
                                    </div>
  
                                    <div class="form-group row">
                                        <label for="name" class="col-md-3 col-form-label">Address:</label>
                                        <div class="col-md-9">
                                            <p class="form-control-plaintext text-muted">{{$contact->address}}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="company_id" class="col-md-3 col-form-label">Company:</label>
                                        <div class="col-md-9">
                                            <p class="form-control-plaintext text-muted">{{$contact->company_id}}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="company_id" class="col-md-3 col-form-label">Date Created:</label>
                                        <div class="col-md-9">
                                            <p class="form-control-plaintext text-muted">{{date('jS M, Y h:i:s a', strtotime(strip_tags($contact->created_at)))}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-9 offset-md-3">
                                            <a href="{{route('contacts.edit', $contact->id)}}" class="btn btn-info">Edit</a>


                                            <div style="display: inline-block;">
                                                <form action="{{ route('contacts.delete', ['contact' => $contact->id, 'redirect' => 'contacts.index']) }}" style="border:none" method="POST" id="deleteForm{{$contact->id}}">
                                                    @csrf
                                                    @method('DELETE')


                                                    {{-- <button class="btn btn-danger" onclick="confirmDelete(event, 'deleteForm{{$contact->id}}')">
                                                        Delete
                                                    </button> --}}

                                                    <button class="btn btn-danger">
                                                        Delete
                                                    </button>

                                                </form>
                                            </div>


                                            <a href="{{route('contacts.index')}}" class="btn btn-outline-secondary">All Contacts</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    
<script>
    function confirmDelete(event, formId) {
        event.preventDefault(); // Prevent form submission

        // Display confirmation box
        if (confirm('Are you sure you want to delete this contact?')) {
            document.getElementById(formId).submit(); // Submit the form
        } else {
            // Do nothing
        }
    }
</script>

</x-main>