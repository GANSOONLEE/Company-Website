
<link rel="stylesheet" href={{ asset('css\includes\filter.css') }}>

<div class="filter">

    <div class="filter-header">
        <i class="fa-solid fa-filter"></i>
        Filter
    </div>

    <form action="" method="GET">
        <div class="filter-body">

            <div class="filter-section">
                <div class="filter-section-box">

                    <div class="checkbox-section">
                        <label class="checkbox-box" for="Origin">
                            <input type="checkbox" data-type="type"name="Original" id="Origin" value="Original" class="checkbox-display">
                            <p class="checkbox-name">Original</p>
                        </label>
                    </div>
                    <div class="checkbox-section">
                        <label class="checkbox-box" for="Non-Origin">
                            <input type="checkbox" data-type="type"name="Non-Original" id="Non-Origin" value="Non-Original" class="checkbox-display">
                            <p class="checkbox-name">Non-Original</p>
                        </label>
                    </div>
                    <div class="checkbox-section">
                        <label class="checkbox-box" for="Recond">
                            <input type="checkbox" data-type="type" name="Recond" id="Recond" value="Recond" class="checkbox-display">
                            <p class="checkbox-name">Recond</p>
                        </label>
                    </div>

                </div>
            </div>

            <div class="filter-section">
                <label class="filter-section-title" for="Model">
                    Car Model
                </label>
                <div class="filter-section-box">

                    @foreach($brands as $brand)
                        <div class="checkbox-section">
                            <label class="checkbox-box" for="{{ $brand->brandName }}">
                                <input type="checkbox" data-type="model" name={{ $brand->brandName }} id="{{ $brand->brandName }}" value={{ $brand->brandName }} class="checkbox-display">
                                <p class="checkbox-name">{{ $brand->brandName }}</p>
                            </label>
                        </div>
                    @endforeach

                </div>
            </div>

        </div>

        <div class="filter-footer">
            {{-- <button type="reset" class="filter-button" id="resetButton" style="width: 100%">Reset Filter</button> --}}
            <button type="button" class="filter-button" id="fetchButton">Search</button>
        </div>
    </form>
</div>

<script src={{ asset('js\includes\filter.js') }}></script>