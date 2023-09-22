<tr>
    <th scope="row">{{ $contacts->firstItem() + $index }}</th> {{--+ $index handles numbering--}}
    <td>{{$contact->first_name}}</td>
    <td>{{$contact->last_name}}</td>
    <td>{{$contact->email}}</td>
    <td>{{$contact->company->name}}</td>
    <td width="150">

        @if($showTrashButtons)
            
            <div style="display: inline-block;">
                <form action="{{ route('contacts.restore', ['contact' => $contact->id]) }}" style="border:none" method="POST" id="deleteForm{{$contact->id}}">
                    @csrf
                    @method('DELETE')

                    
                    <button class="btn btn-sm btn-circle btn-outline-success">
                        <i class="fa fa-undo"></i>
                    </button>

                </form>
            </div> 

            <div style="display: inline-block;">
                <form action="{{ route('contacts.force-delete', ['contact' => $contact->id]) }}" style="border:none" method="POST" id="deleteForm{{$contact->id}}">
                    @csrf
                    @method('DELETE')

                    
                    <button class="btn btn-sm btn-circle btn-outline-danger" onclick="confirmDelete(event, 'deleteForm{{$contact->id}}')"><i class="fa fa-times"></i></button>

                </form>
            </div>

        @else
            
            <a href="{{route('contacts.show', $contact->id)}}" class="btn btn-sm btn-circle btn-outline-info" title="Show">
                <i class="fa fa-eye"></i>
            </a>
            <a href="{{route('contacts.edit', $contact->id)}}" class="btn btn-sm btn-circle btn-outline-secondary" title="Edit">
                <i class="fa fa-edit"></i>
            </a>
            

            <div style="display: inline-block;">
                <form action="{{ route('contacts.delete', ['contact' => $contact->id]) }}" style="border:none" method="POST" id="deleteForm{{$contact->id}}">
                    @csrf
                    @method('DELETE')

                    {{-- <button class="btn btn-sm btn-circle btn-outline-danger" onclick="confirmDelete(event, 'deleteForm{{$contact->id}}')"><i class="fa fa-times"></i></button> --}}
                    
                    <button class="btn btn-sm btn-circle btn-outline-danger">
                        <i class="fa fa-trash"></i>
                    </button>

                </form>
            </div>    


        @endif

    </td>
</tr>

<script>
    function confirmDelete(event, formId) {
        event.preventDefault(); // Prevent form submission

        // Display confirmation box
        if (confirm('Are you sure you want to delete this contact permanently?')) {
            document.getElementById(formId).submit(); // Submit the form
        } else {
            // Do nothing
        }
    }
</script>