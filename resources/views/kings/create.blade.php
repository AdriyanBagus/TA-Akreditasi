<h1>Create King</h1>
<form action='{{ route('kings.store') }}' method='POST'>
    @csrf
    <div class='form-group'>
            <label for='adi'>adi</label>
            <input type='text' name='adi' class='form-control' value='{{ old('adi', $item->adi ?? '') }}'>
        </div>
<div class='form-group'>
            <label for='sucipto'>sucipto</label>
            <input type='text' name='sucipto' class='form-control' value='{{ old('sucipto', $item->sucipto ?? '') }}'>
        </div>

    <button type='submit' class='btn btn-primary'>Save</button>
</form>