
<style>
    div.alert{
        width: 20%;
        height: 8vh;
        background-color: white;
        position: fixed;
        top: 6rem;
        left: 50%;
        transform: translateX(-50%);
        z-index: 999;
        box-shadow: 0 0 10px #00000022;
        padding: 1rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        opacity: 0;
    }
    
    div.alert-content{
        display: flex;
        justify-content: flex-start;
        align-items: center;
    }

    i.fa-solid.fa-circle-check{
        font-size: var(--font-h5);
        margin-right: 2rem;
    }

    p.alert-text{
        font-size: var(--font-small)
    }

    i.close-alert-icon{
        cursor: pointer;
        height: none;
        width: 0;
        margin-right: .6rem;
        font-size: var(--font-small)
    }
    
</style>

<!-- html -->
<section class="notification">

    <div class="alert">
        <div class="alert-content">
            <i class="fa-solid fa-circle-check" style="color: #0ba300;"></i>
            <p class="alert-text">
                Success add to cart!
            </p>
        </div>
        <i class="close-alert-icon fa-solid fa-xmark"></i>
    </div>

</section>

<script>

    class Alert{

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
            $('.close-alert-icon').click(()=>{
                this.hide();
            })
        }

        showAlert(){
            this.element.show();
            for(let i = 0; i < 1; i){
                setTimeout(()=>{
                    this.element.css('opacity', i)
                }, 125)
                i = i + 0.01;
                console.log(i)
            }
        }

        hideAlert(){
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
            this.showAlert();
            setTimeout(() => {
                this.hideAlert();
            }, duration);
        }

    }

    let notification = new Alert($('.alert'));

</script>

