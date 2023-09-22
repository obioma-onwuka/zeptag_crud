<x-main>
    @section('title', 'Contacts')
    <main class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-title">
                            <div class="d-flex align-items-center">
                                <h2 class="mb-0">
                                    All Contacts
                                    @if( request()->query('trash') )
                                    
                                        <small>(In Trash)</small>
                                       
                                    @endif
                                </h2>
                                <div class="ml-auto">
                                    <a href="{{route('contacts.create')}}" class="btn btn-success">
                                        <i class="fa fa-plus-circle"></i> 
                                        Add New
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if($message = session('success'))

                                <div class="alert alert-success text-center">

                                    {{$message}}

                                    @if($undoRoute = session('undoRoute'))
                                    
                                        <form action="{{ $undoRoute }}" method = "POST" style = "disply:inline">

                                            @csrf
                                            @method('DELETE')

                                            <button class = "btn btn-link">Undo</button>
                                        </form>
                                        
                                    @endif

                                </div>
                                

                            @endif
                            
                            @include('contacts._filter')
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope = "col">S/No</th>
                                        
                                        <th scope = "col">
                                            {!! sortable("First Name") !!}
                                        </th>

                                        <th scope = "col">
                                            {!! sortable("Last Name") !!}
                                        </th>
                                        <th scope = "col">
                                            {!! sortable("Email") !!}
                                        </th>
                                        <th scope = "col">Company</th>
                                        <th scope = "col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @php
                                        
                                        $showTrashButtons = request()->query('trash') ? true:false

                                    @endphp

                                    @forelse ($contacts as $index => $contact) {{--as $index handles numbering--}}
                                    
                                        @include('contacts._contacts', ['contact' => $contact, 'index' =>$index]) {{--'index' => $index handles numbering--}}

                                    @empty

                                        @include('contacts._empty')

                                    @endforelse
                                
                                
                                    {{-- @each('contacts._contacts', $contacts, 'contact', 'contacts._empty') --}}
                                </tbody>
                            </table> 

                            {{$contacts->appends(request()->only('orderBy', 'q'))->links()}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-main>