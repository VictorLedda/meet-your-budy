class Apparition {
        
    constructor() {
      this.init();
    
    }
    init(){
    this.initObserver()
    
    }


initObserver() {
    
    const intersectionObserver = new window.IntersectionObserver(
      entries => {
        entries.forEach(entry => {
          //entry.target est l'element html en lui meme
          if (entry.intersectionRatio > 0.2) {
            
            entry.target.classList.add("is-inviewport");
            
          } else {
            //dehors
            entry.target.classList.remove("is-inviewport");
          }
        });
      },
      { threshold: 0.2 }
    );
    //observation des objets
    document.querySelectorAll(".scroll-part").forEach(element => {
      intersectionObserver.observe(element);
    });
  }

  setActiveMenuElement(id) {
    this.links.forEach((link) => {
      link.classList.remove("is-active");
      if (link.getAttribute("href") == "#" + id) {
        link.classList.add("is-active");
      }
    });
  }

  

}

const App = new Apparition();
