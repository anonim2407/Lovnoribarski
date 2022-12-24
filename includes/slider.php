<section class="cld">
    <!-- image lsider start -->
    <div class="slider">
        <div class="slides">
            <!-- radio buttons start -->
            <input type="radio" name="radio-btn" id="radio1">
            <input type="radio" name="radio-btn" id="radio2">
            <input type="radio" name="radio-btn" id="radio3">
            <input type="radio" name="radio-btn" id="radio4">
             <input type="radio" name="radio-btn" id="radio5"> 
            <!-- radio butons end -->
            <!-- slide image start -->
            <div class="slide first">
                <img src="/build/img/galeria/gal1.webp" alt="Image1">
            </div>
            <div class="slide">
                <img src="/build/img/galeria/gal2.webp" alt="Image2">
            </div>
            <div class="slide">
                <img src="/build/img/galeria/gal3.webp" alt="Image3">
            </div>
            <div class="slide">
                <img src="/build/img/galeria/gal4.webp" alt="Image4">
            </div>
            <div class="slide">
                <img src="/build/img/galeria/gal5.webp" alt="Image5">
            </div> 
            <!-- slide image end -->
            <!-- automatic navigation start -->
            <div class="navigation-auto">
                <div class="auto-btn1"></div>
                <div class="auto-btn2"></div>
                <div class="auto-btn3"></div>
                <div class="auto-btn4"></div>
                <div class="auto-btn4"></div> 
            </div>
            <!-- automatic navigation end -->
        </div>
        <!-- manual navigation start -->
        <div class="navigation-manual">
            <label for="radio1" class="manual-btn"></label>
            <label for="radio2" class="manual-btn"></label>
            <label for="radio3" class="manual-btn"></label>
            <label for="radio4" class="manual-btn"></label>
            <label for="radio5" class="manual-btn"></label>
        </div>
        <!-- manual navigation end -->
    </div>
    <!-- image slider end -->

    <script type="text/javascript">
        var counter = 1;
        setInterval(function(){
            document.getElementById('radio' + counter).checked = true;
            counter++;
            if(counter > 5){
                counter = 1;
            }
        },5000)
    </script>
</section>