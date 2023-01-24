// hieu ung tuyet roi
const LIFE_PER_TICK = 900 / 60;
const MAX_FLAKES = Math.min(75, screen.width / 1280 * 5);
const flakes = [];
const period = [
    n => 5 * (Math.sin(n)),
    n => 8 * (Math.cos(n)),
    n => 5 * (Math.sin(n) * Math.cos(2 * n)),
    n => 2 * (Math.sin(0.25 * n) - Math.cos(0.75 * n) + 1),
    n => 5 * (Math.sin(0.75 * n) + Math.cos(0.25 * n) - 1)
];
const fun = ['⛄', '🎁', '🦌', '☃', '🍪'];
const cssString = `.snowfall-container {
    display: block;
    height: 100vh;
    left: 0;
    margin: 0;
    padding: 0;
    -webkit-perspective-origin: top center;
            perspective-origin: top center;
    -webkit-perspective: 150px;
            perspective: 150px;
    pointer-events: none;
    position: fixed;
    top: 0;
    -webkit-transform-style: preserve-3d;
            transform-style: preserve-3d;
    width: 100%;
    z-index: 99999; }

  .snowflake {
    pointer-events: none;
    color: #ddf;
    display: block;
    font-size: 24px;
    left: -12px;
    line-height: 24px;
    position: absolute;
    top: -12px;
    -webkit-transform-origin: center;
            transform-origin: center; }`;
function ready(fn) {
    if (document.attachEvent ? document.readyState === 'complete' : document.readyState !== 'loading') {
        fn();
    }
    else {
        document.addEventListener('DOMContentLoaded', fn);
    }
}
function resetFlake(flake) {
    let x = flake.dataset.origX = (Math.random() * 100);
    let y = flake.dataset.origY = 0;
    let z = flake.dataset.origZ = (Math.random() < 0.1) ? (Math.ceil(Math.random() * 100) + 25) : 0;
    let life = flake.dataset.life = (Math.ceil(Math.random() * 4000) + 6000); 
    flake.dataset.origLife = life;
    flake.style.transform = `translate3d(${x}vw, ${y}vh, ${z}px)`;
    flake.style.opacity = 1.0;
    flake.dataset.periodFunction = Math.floor(Math.random() * period.length);

    if (Math.random() < 0.001) {
        flake.innerText = fun[Math.floor(Math.random() * fun.length)];
    }
}
function updatePositions() {

    flakes.forEach((flake) => {
        let origLife = parseFloat(flake.dataset.origLife)
        let curLife = parseFloat(flake.dataset.life);
        let dt = (origLife - curLife) / origLife;

        if (dt <= 1.0) {
            let p = period[parseInt(flake.dataset.periodFunction)];
            let x = p(dt * 2 * Math.PI) + parseFloat(flake.dataset.origX);
            let y = 100 * dt;
            let z = parseFloat(flake.dataset.origZ);
            flake.style.transform = `translate3d(${x}vw, ${y}vh, ${z}px)`;
            if (dt >= 0.5) {
                flake.style.opacity = (1.0 - ((dt - 0.5) * 2));
            }
            curLife -= LIFE_PER_TICK;
            flake.dataset.life = curLife;
        }
        else {
            resetFlake(flake);
        }
    });
    window.requestAnimationFrame(updatePositions);
}
function appendSnow() {
    let styles = document.createElement('style');
    styles.innerText = cssString;
    document.querySelector('head').appendChild(styles);
    let field = document.createElement('div');
    field.classList.add('snowfall-container');
    field.setAttribute('aria-hidden', 'true');
    field.setAttribute('role', 'presentation');
    document.body.appendChild(field);
    let i = 0;
    const addFlake = () => {
        let flake = document.createElement('span');
        flake.classList.add('snowflake');
        flake.setAttribute('aria-hidden', 'true');
        flake.setAttribute('role', 'presentation');
        flake.innerHTML = "<img style='width:30px;height:30px;' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAEtGlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjEwMCIKICAgZXhpZjpQaXhlbFlEaW1lbnNpb249IjEwMCIKICAgZXhpZjpDb2xvclNwYWNlPSIxIgogICB0aWZmOkltYWdlV2lkdGg9IjEwMCIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMTAwIgogICB0aWZmOlJlc29sdXRpb25Vbml0PSIyIgogICB0aWZmOlhSZXNvbHV0aW9uPSI3Mi8xIgogICB0aWZmOllSZXNvbHV0aW9uPSI3Mi8xIgogICBwaG90b3Nob3A6Q29sb3JNb2RlPSIzIgogICBwaG90b3Nob3A6SUNDUHJvZmlsZT0ic1JHQiBJRUM2MTk2Ni0yLjEiCiAgIHhtcDpNb2RpZnlEYXRlPSIyMDIz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'/>";
        resetFlake(flake);
        flakes.push(flake);
        field.appendChild(flake);
        if (i++ <= MAX_FLAKES) {
            setTimeout(addFlake, Math.ceil(Math.random() * 300) + 100);
        }
    };
    addFlake();
    updatePositions();
}
ready(appendSnow);