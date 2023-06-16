<div class="searchbar" style="width: 100vw; height: 5rem; background-color: #adadad; position: sticky; top:0;">
    <form action="{{ isset($productType) ? route('product.search', ['productType' => $productType]) : route('product.search') }}" method="post" class="form" style="display: flex; flex-direction: row; justify-content: end; align-items: center; height: 100%; padding: 0 5rem;width: 100vw;">
        @csrf
        <input type="text" placeholder="search.." name="searchbarText" class="searchbarInput" style="width: 20vw; max-width: 170px; padding: .5rem 2rem; font-size: var(--font-h6); font-family: Itim; font-weight: light">
    </form>
</div>

<style>
    .searchbar{
        z-index: 999;
    }
    
    .searchbarInput{
        outline: none;
        border: none;
        color: black;
        background-color: rgba(255, 255, 255, 0.5);
        border-radius: 4px;
    }
    .searchbarInput:focus{
        background-color: rgba(255, 255, 255, 0.75);
    }
    .searchbarInput::placeholder{
        color: black;
    }

</style>