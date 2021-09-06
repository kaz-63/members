var mouseX = 0,
mouseY = 0,
windowHalfX = window.innerWidth / 2,
windowHalfY = window.innerHeight / 2,
SEPARATION = 200,
AMOUNTX = 10,
AMOUNTY = 10,
camera, scene, renderer;
init('bg_spiderweb', 'rgb(212, 204, 255)');
animate();

function init(el = false, color = '#fff') {
var color = color,
    a, b = 100,
    f = 50,
    e = 50,
    d;
if (el === false) {
    a = document.createElement("div");
    document.body.appendChild(a);
} else {
    a = document.getElementById(el);
}
scene = new THREE.Scene();
renderer = new THREE.CanvasRenderer({
    alpha: true
});
renderer.setSize(window.innerWidth, window.innerHeight);
a.appendChild(renderer.domElement);
camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 1, 10000);
camera.position.z = 100;
// var j = Math.PI * 2;
var g = new THREE.SpriteCanvasMaterial({
    color: color,
    program: function(i) {
        i.beginPath();
        i.arc(0, 0, 0.5, 0, Math.PI * 2, true);
        i.fill()
    }
});
var h = new THREE.Geometry();
for (var c = 0; c < 100; c++) {
    d = new THREE.Sprite(g);
    d.position.x = Math.random() * 2 - 1;
    d.position.y = Math.random() * 2 - 1;
    d.position.z = Math.random() * 2 - 1;
    d.position.normalize();
    d.position.multiplyScalar(Math.random() * 10 + 450);
    d.scale.x = d.scale.y = 10;
    scene.add(d);
    h.vertices.push(d.position)
}
var k = new THREE.Line(h, new THREE.LineBasicMaterial({
    color: color,
    opacity: 0.5
}));
scene.add(k);
document.addEventListener("mousemove", onDocumentMouseMove, false);
document.addEventListener("touchstart", onDocumentTouchStart, false);
document.addEventListener("touchmove", onDocumentTouchMove, false);
window.addEventListener("resize", onWindowResize, false)
}

function onWindowResize() {
windowHalfX = window.innerWidth / 2;
windowHalfY = window.innerHeight / 2;
camera.aspect = window.innerWidth / window.innerHeight;
camera.updateProjectionMatrix();
renderer.setSize(window.innerWidth, window.innerHeight)
}

function onDocumentMouseMove(a) {
mouseX = a.clientX - windowHalfX;
mouseY = a.clientY - windowHalfY
}

function onDocumentTouchStart(a) {
if (a.touches.length > 1) {
    a.preventDefault();
    mouseX = a.touches[0].pageX - windowHalfX;
    mouseY = a.touches[0].pageY - windowHalfY
}
}

function onDocumentTouchMove(a) {
if (a.touches.length == 1) {
    a.preventDefault();
    mouseX = a.touches[0].pageX - windowHalfX;
    mouseY = a.touches[0].pageY - windowHalfY
}
}

function animate() {
requestAnimationFrame(animate);
render()
}

function render() {
camera.position.x += (mouseX - camera.position.x) * 0.05;
camera.position.y += (-mouseY + 200 - camera.position.y) * 0.05;
camera.lookAt(scene.position);
renderer.render(scene, camera)
};
