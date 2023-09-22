<x-main>
    @section('title', 'Add Contact')
    <main class="py-5">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-title">
                            <strong>Add New Contact</strong>
                        </div>           
                        <div class="card-body">

                            @if($message = session('success'))

                                <div class="alert alert-success text-center">

                                    {{$message}}

                                </div>

                            @endif

                            @if($message = session('error'))

                                <div class="alert alert- text-center">

                                    {{$message}}

                                </div>

                            @endif
                            
                            <form action="{{route('contacts.store')}}" method="POST">

                                @csrf
                                @include('contacts._form')

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-main>