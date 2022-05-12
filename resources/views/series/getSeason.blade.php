<select name="season_id" id="seasonType" class="form-control create-form">
    <option value="0" selected>Select Season</option>
    @foreach ($seasonList as $id => $name)
        <option value="{{ $id }}">{{ $name }}</option>
    @endforeach
</select>
