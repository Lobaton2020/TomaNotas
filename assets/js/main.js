class LoadPage {
    constructor() {
        this.LAST_URL_KEY = "LAST_URL_KEY"
    }
    setUrl(strRemove) {
        localStorage.setItem(this.LAST_URL_KEY, location.href.replace(strRemove, ''))
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
        const KEY_PARAM = "is_new"
        const loadPage = new LoadPage()
        const lastPage = loadPage.getUrl();
        loadPage.setUrl(KEY_PARAM)
        const params = new URLSearchParams(location.href)
        if (params.get(KEY_PARAM) === "true") {
            loadPage.reload(lastPage)
        }
    } catch (err) {
        console.log("ERROR_LOAD_PAGE", err)
    }
}
document.addEventListener("DOMContentLoaded", init)