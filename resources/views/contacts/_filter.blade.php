<div class="row">
    <div class="col-md-6">
        
        <div class="row">

            <div class="col">

                <a href="{{ request()->fullUrlWithQuery(['trash' => false]) }}" class="btn {{ !request()->query('trash') ? 'text-primary' : 'text-secondary' }}">All</a> &nbsp;
                <a href="{{ request()->fullUrlWithQuery(['trash' => true]) }}" class="btn {{ request()->query('trash') ? 'text-primary' : 'text-secondary' }}">Trash</a>

            </div>

        </div>

    </div>
    <div class="col-md-6">
        
        <form method="GET">

            <input type="hidden" name="trash" value = "{{ request()->query('trash') }}">

            <div class="row">
            
                <div class="col">
                    @includeUnless(empty($companies), 'contacts._company-selection')
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <input type="text" name = "search" value = "{{ request()->query('search') }}" id = "search_input" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="button-addon2">
                        <div class="input-group-append">

                            @if(request()->filled('search') || request()->filled('company_id'))

                                <button class="btn btn-outline-secondary" type="button" onclick="document.getElementById('search_input').value = '', document.getElementById('search_select').selectedIndex = 0, this.form.submit()">
                                    <i class="fa fa-refresh"></i>
                                </button>

                            @endif

                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                                <i class="fa fa-search"></i>
                            </button>

                        </div>
                    </div>
                </div>
            </div>

        </form>

    </div>
    <div class="col-md-12">
        {{$contacts->appends(request()->only('orderBy', 'q'))->links()}}
    </div>
</div>