<script type="text/javascript">
(function() {
function async_load(u, id) {
    if (!gid(id)) {
    s = "script", d = document,
    o = d.createElement(s);
    o.type = 'text/javascript';
    o.id = id;
    o.async = true;
    o.src = u;
    // Creating scripts on page
    x = d.getElementsByTagName(s)[0];
    x.parentNode.insertBefore(o, x);
    }
}

function gid(id) {
    return document.getElementById(id);
}
window.onload = function() {
    async_load("//vk.com/js/api/openapi.js?169", "id-vkontakte"); //vkontakte
};
// Инициализация vkontakte
window.vkAsyncInit = function() {
    VK.init({
      apiId: 4040691,
      onlyWidgets: true
    });
    VK.Widgets.Like("vk_like", {
      type: "button",
      height: 40
    });
    VK.Widgets.Group("vk_groups", {
      mode: 2,
      width: "220",
      height: "1000"
    }, 62738566);
};
})();
</script>