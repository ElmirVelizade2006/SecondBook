document.addEventListener("DOMContentLoaded", ()=>{


    // Dashboard cards animation

    const cards=document.querySelectorAll(".dashboard-card");

    cards.forEach((card,index)=>{

        card.style.opacity=0;

        card.style.transform="translateY(30px)";

        setTimeout(()=>{

            card.style.transition=".5s";

            card.style.opacity=1;

            card.style.transform="translateY(0)";

        },150*index);

    });

});