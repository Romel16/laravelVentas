<select name="ciudad" id="select_ciudad" class="form-control">
    @foreach($ciudades as $ciudade)
        <option value="{{$ciudade->id}}">{{$ciudade->name}}</option>
    @endforeach
</select>
