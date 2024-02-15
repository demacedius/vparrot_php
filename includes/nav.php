<nav class="text-secondary bg-primary md:flex md:items-center md:justify-between lg:max-w-[1024px] lg:mx-auto lg:pt-4">
    <div class="py-4 px-4 flex justify-between">
        <span class="text-2xl font-bold font-primary">Vparrot</span>
        <ion-icon class="text-secondary text-3xl md:hidden block cursor-pointer" name="menu"
            onclick="Menu(this)"></ion-icon>
    </div>
    <ul
        class="font-secondary font-semibold md:flex md:items-center bg-primary md:static absolute
            w-full md:w-auto left-0 md:py-0 py-4 md:pl-0 pl-7 md:opacity-100 opacity-0 top-[-400px] transition-all ease-in duration-500">
        <li class="my-6 md:my-0"><a class="hover:text-cta md:text-lg  lg:text-xl duration-500 md:mx-4" href="index.php"
                >Acceuil</a></li>
        <li class="my-6 md:my-0"><a class="hover:text-cta md:text-lg  lg:text-xl duration-500 md:mx-4" href="about.php"
                >A propos</a></li>
        <li class="my-6 md:my-0"><a class="hover:text-cta md:text-lg  lg:text-xl duration-500 md:mx-4" href="#"
                target="_blank">Nos voiture</a></li>
        <?php if(!isset($_SESSION["user"])): ?>
        <a href="login.php"><button  class="bg-cta text-secondary font-bold font-primary p-2 rounded-full ">Ce connecter</button></a>
        <?php else: ?>
        <a href="deconnexion.php"><button  class="bg-cta text-secondary font-bold font-primary p-2 rounded-full ">Ce déconnecter</button></a>
        <?php endif; ?>
    </ul>
</nav>

<script>
    function Menu(e) {
        let liste = document.querySelector('ul');
        e.name === "menu" ? (e.name = "close", liste.classList.add('top-[50px]'), liste.classList.add('opacity-100')) : (e.name = "menu", liste.classList.remove('top-[50px]'), liste.classList.remove('opacity-100'))
    }
</script>