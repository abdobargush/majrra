<label for="select-category">{{ __('Tool or Technology') }}</label>
<select name="tools[]" id="select-category" class="custom-select" data-placeholder="{{ __('Select tutorial\'s field') }}" multiple>
    @foreach ($categoriesList as $category)
    <option value="{{ $category->id }}">{{ $category->title }}</option>
    @endforeach
</select>