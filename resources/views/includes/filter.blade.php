
<link rel="stylesheet" href={{ asset('css\includes\filter.css') }}>

<div class="filter">

    <div class="filter-header">
        <i class="fa-solid fa-filter"></i>
        篩選條件
    </div>

    <form action="" method="GET">
        <div class="filter-body">

            <div class="filter-section">
                <input type="checkbox" name="Model" id="Model">
                <label class="filter-section-title" for="Model">
                    Car Model
                </label>
                <div class="filter-section-box">

                    @foreach($models as $model)
                        <div class="checkbox-section">
                            <label class="checkbox-box" for={{ $model->modelName }}>
                                <input onchange="updateURLParams()" type="checkbox" name={{ $model->modelName }} id={{ $model->modelName }} value={{ $model->modelName }} class="checkbox-display">
                                <p class="checkbox-name">{{ $model->modelName }}</p>
                            </label>
                        </div>
                    @endforeach

                </div>
            </div>

        </div>

        <div class="filter-footer">
            <button type="reset" class="resetButton">Reset Filter</button>
            <button type="button" class="fetchButton">Get Data</button>
        </div>
    </form>
</div>

<script src={{ asset('js\includes\filter.js') }}></script>