
<link rel="stylesheet" href={{ asset('css\includes\filter.css') }}>

<div class="filter">

    <div class="filter-header">
        <i class="fa-solid fa-filter"></i>
        Filter
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
                                <input type="checkbox" name={{ $model->modelName }} id={{ $model->modelName }} value={{ $model->modelName }} class="checkbox-display">
                                <p class="checkbox-name">{{ $model->modelName }}</p>
                            </label>
                        </div>
                    @endforeach

                </div>
            </div>

        </div>

        <div class="filter-footer">
            <button type="reset" class="filter-button resetButton">Reset Filter</button></a>
            <button type="button" class="filter-button fetchButton">Get Data</button>
        </div>
    </form>
</div>

<script src={{ asset('js\includes\filter.js') }}></script>