<div>
    <form class="user">

        @if($errors->any())
            @foreach($errors->all() as $error)

            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>OPS!</strong>  {{ $error }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endforeach
        @elseif(Session::has('message'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h4 class="alert-heading">Well done!</h4>
            <p>{!! Session::get('message') !!}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>   
        @endif
        
        <div class="form-group row"> 
            
            <div class="col-md-4">
                <label for="name">Destination From</label>
                <select wire:model="from" class="form-control">
                    <option selected disabled>Choose Airport Station</option>
                    @foreach($airports as $airport)
                        <option value="{{$airport->id}}">
                            {{ $airport->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-md-4">
                <label for="name">Destination To</label>
                <input type="text" name="name" class="form-control form-control-user
                    @error('name') border border-danger @enderror"  id="name"
                    placeholder="Full Name" value="{{ old('name')}}">
            </div>

            <div class="col-md-4">
                <label for="name">Flight</label>
                <input type="text" wire:model="test" class="form-control form-control-user
                    @error('name') border border-danger @enderror"  id="name"
                    placeholder="Full Name" value="{{ old('name')}}">
            </div>
            
        </div>
        <button type="submit" class="btn custom btn-user btn-block">
            {{ $test }}
        </button>
    </form>
</div>
