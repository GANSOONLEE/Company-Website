
<style>

div#modal{
    width: 40%;
    background-color: white;
    border: .2px solid #00000044;
    box-shadow: 0 0 4px #00000044;
    border-radius: 6px;
    display: flex;
    flex-direction: column;
    position: absolute;
    top: 4rem;
    left: 50%;
    transform: translateX(-37.5%);
    transition: all .15s ease-in-out;
    padding: 3.4rem 2.6rem 1.6rem;
    z-index: 99;
}

modal-dialog{
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: center;
    row-gap: 3.2rem;
    font-size: var(--font-h6);
    margin-bottom: .8rem;
}

#modal > button.confirm-button{
    font-size: var(--font-small);
    align-self: center;
    padding: .6rem 2.2rem;
    outline: none;
    border: none;
    border-radius: 2px;
    background-color: green;
    color: white;
}

#modal > button.confirm-button:active{
    outline: 3px solid rgb(0, 67, 0);
}


</style>

<div id="modal">
    <modal-dialog>
        <i class="fa-beat fa-xl"></i>
        <p class="description"></p>
    </modal-dialog>
    <button class="confirm-button" type="button">Ok</button>
</div>

<!-- The class of this component -->
<script>

class Modal{

    element;
    description;
    icon;

    constructor(element){
        this.element = element;
        element.hide();
        element.css('opacity', '0');
        this.init();
    }

    init(){
        $('.confirm-button').click(()=>{
            this.hide();
        })
    }

    setUp(description, icon){
        $('.description').text(description);
        $('i').addClass(icon);
    }

    show(){
        this.element.show();
        for(let i = 0; i < 1; i){
            setTimeout(()=>{
                this.element.css('opacity', i)
            }, 125)
            i = i + 0.01;
        }
    }

    hide(){
        for(let i = 1; i > 0; i){
            setTimeout(()=>{
                this.element.css('opacity', i)
            }, 325)
            i = i - 0.01;
            if(i==0){
                this.element.hide();
            }
        }
        
    }

    autoShow(duration){
        this.show();
        setTimeout(() => {
            this.hide();
        }, duration);
    }

}

let notification = new Modal($('#modal'));

</script>