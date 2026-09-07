const sidebar = document.querySelector(".sidebar");
const main = document.querySelector(".main");
const toggle = document.getElementById("toggleSidebar");
const closeBtn = document.getElementById("closeSidebar");
const overlay = document.getElementById("sidebarOverlay");

function isDesktop(){
    return window.innerWidth > 992;
}

function isSidebarOpen(){
    return sidebar.classList.contains("show");
}

function setToggleState(isOpen){
    toggle.classList.toggle("is-active", isOpen);
    toggle.setAttribute("aria-expanded", isOpen ? "true" : "false");
}

function openSidebar(){
    sidebar.classList.add("show");
    document.body.classList.add("sidebar-open");
    setToggleState(true);
}

function closeSidebar(){
    sidebar.classList.remove("show");
    document.body.classList.remove("sidebar-open");
    setToggleState(false);
}

function toggleSidebarMenu(){
    if(isSidebarOpen()){
        closeSidebar();
    }else{
        openSidebar();
    }
}

function initSidebar(){
    if(isDesktop()){
        openSidebar();
    }else{
        closeSidebar();
    }
}

toggle.addEventListener("click", (event) => {
    event.stopPropagation();
    toggleSidebarMenu();
});

if(closeBtn){
    closeBtn.addEventListener("click", (event) => {
        event.stopPropagation();
        closeSidebar();
    });
}

if(overlay){
    overlay.addEventListener("click", () => {
        closeSidebar();
    });
}

document.addEventListener("keydown", (event) => {
    if(event.key === "Escape" && isSidebarOpen()){
        closeSidebar();
    }
});

let lastIsDesktop = isDesktop();

window.addEventListener("resize", () => {
    const nowDesktop = isDesktop();

    if(nowDesktop === lastIsDesktop){
        return;
    }

    lastIsDesktop = nowDesktop;
    initSidebar();
});

initSidebar();
