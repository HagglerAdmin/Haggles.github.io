@foreach ($city as $city)
    <option data-subtext="{{ $city->province }}" value="{{ $city->city.','.$city->province }}">{{ $city->city }}</option>
@endforeach
