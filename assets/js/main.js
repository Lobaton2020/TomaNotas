class LoadPage {
    constructor() {
        this.LAST_URL_KEY = "LAST_URL_KEY"
    }
    setUrl() {
        localStorage.setItem(this.LAST_URL_KEY, location.href)
    }
    getUrl() {
        return localStorage.getItem(this.LAST_URL_KEY) ?? location.href
    }
    reload(url) {
        location.href = url
    }
}
const init = () => {
    try {
        const loadPage = new LoadPage()
        const lastPage = loadPage.getUrl();
        loadPage.setUrl()
        const params = new URLSearchParams(location.href)
        if (params.get("is_new") === "true") {
            loadPage.reload(lastPage)
        }
    } catch (err) {
        console.log("ERROR_LOAD_PAGE", err)
    }
}
document.addEventListener("DOMContentLoaded", init)