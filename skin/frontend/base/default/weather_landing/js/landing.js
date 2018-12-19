var LandingHelper = {
    $j: jQuery,
    config: {
        contentSelector: '#wether-landing-main',
        loaderHtml: '<div id="overlay-loader">' +
            '<i class="fa fa-spinner fa-pulse fa-4x fa-fw" aria-hidden="true"></i>' +
            '</div>',
        overlayLoaderSelector: '#overlay-loader',
        ajaxErrorMessage: '<div id="ajax-error-block" class="jumbotron">' +
            '<h3 class="text-danger">' +
            '<i class="fa fa-frown-o fa-3x" aria-hidden="true"></i> Error occurred, try again later.' +
            '</h3>' +
            '</div>',
        linkActiveClass: 'active'
    },

    /**
     *
     */
    getContentBlock: function () {
        return this.$j(this.config.contentSelector);
    },

    /**
     *
     */
    cleanUpContent: function () {
        this.getContentBlock().empty();
    },

    /**
     *
     * @returns {string}
     */
    getLoader: function () {
        return this.config.loaderHtml;
    },

    /**
     *
     */
    showLoader: function () {
        this.$j('body').append(this.getLoader());
    },

    /**
     *
     */
    removeLoader: function () {
        this.$j(this.config.overlayLoaderSelector).remove();
    },

    /**
     *
     */
    showAjaxErrorMessage: function () {
        this.getContentBlock().append(this.config.ajaxErrorMessage);
    }
};

var LandingStaticPages = {
    helper: LandingHelper,
    $j: jQuery,
    config: {
        menuCmsLinksSelector: '#cms-pages-links'
    },

    /**
     *
     */
    removeOldActiveLink: function () {
        // remove old active link in navbar
        this.$j(this.config.menuCmsLinksSelector).closest('ul.nav').children().removeClass(this.helper.config.linkActiveClass);
        // remove old active link in dropdown
        this.$j(this.config.menuCmsLinksSelector).children().removeClass(this.helper.config.linkActiveClass);
    },

    /**
     *
     * @param $link jQuery {object}
     */
    setActiveLink: function ($link) {
        this.removeOldActiveLink();
        // set active link in navbar
        $link.parent().closest('li.dropdown').addClass(this.helper.config.linkActiveClass);
        // set active link in dropdown
        $link.parent().addClass(this.helper.config.linkActiveClass);
    },

    /**
     *
     * @returns {*}
     */
    getLinks: function () {
        return this.$j(this.config.menuCmsLinksSelector).find('a');
    },

    /**
     * Logic for load Static pages from menu
     */
    getCmsContent: function () {
        var self = this;
        var helper = self.helper;
        var links = self.getLinks();
        links.on('click', function (event) {
            event.preventDefault();

            var link = helper.$j(this);
            self.setActiveLink(link);

            helper.showLoader();
            helper.cleanUpContent();

            var request = self.$j.ajax({
                url: link.attr('href'),
                method: 'GET',
                dataType: 'html'
            });

            request.done(function (result) {
                helper.getContentBlock().append(result);
                helper.removeLoader();
            });

            request.fail(function (jqXHR, textStatus) {
                console.log('Request failed: ' + textStatus);
                helper.showAjaxErrorMessage();
                helper.removeLoader();
            });

        })
    },

    /**
     * Initialize loading cms pages
     */
    init: function () {
        this.getCmsContent();
    }
};

var LandingWeather = {
    $j: jQuery,
    helper: LandingHelper,
    widgetTemplateSelector: '#weather-landing-widget-tmpl',
    menuLinkSelector: '[data-page-main]',
    weatherData: null,
    interval: undefined,

    /**
     * Layout config object
     * @returns {*}
     */
    getConfig() {
        return window.LandingWeatherApiConfig;
    },

    /**
     *
     * @param code
     * @returns {string}
     */
    getIconUrl: function (code) {
        return this.getConfig().apiIconEndpoint + code + this.getConfig().apiIconExtention;
    },

    /**
     *
     * @param {number} unixTimestamp
     * @returns {string}
     */
    timeConverter: function (unixTimestamp) {
        var date = new Date(unixTimestamp * 1000);
        var h = date.getHours();
        var m = "0" + date.getMinutes();
        return h + ':' + m.substr(-2);
    },

    /**
     * Make AJAX call to get weather JSON
     * @returns {*|{readyState, getResponseHeader, getAllResponseHeaders, setRequestHeader, overrideMimeType, statusCode, abort}}
     */
    getWeatherData: function () {
        return this.$j.ajax({
            url: this.getConfig().apiEndpoint,
            method: 'GET',
            data: this.getConfig().apiParams,
            dataType: 'json'
        });
    },

    /**
     *
     * @returns {*}
     */
    getTemplateData: function () {
        if (!this.weatherData) return {};
        var weather = this.weatherData;
        return {
            city: weather.name,
            country: weather.sys.country,
            iconSrc: this.getIconUrl(weather.weather[0].icon),
            temp: weather.main.temp,
            description: weather.weather[0].description,
            clouds: weather.clouds.all,
            humidity: weather.main.humidity,
            wind: weather.wind.speed,
            pressure: weather.main.pressure,
            sunrise: this.timeConverter(weather.sys.sunrise),
            sunset: this.timeConverter(weather.sys.sunset),
        };
    },

    /**
     *
     */
    processWidget: function () {
        var self = this;
        var request = self.getWeatherData();
        request.done(function (result) {
            self.weatherData = result;
            var tmplData = self.getTemplateData();
            self.helper.cleanUpContent();
            // Render widget from jQuery TMPL
            self.$j(self.widgetTemplateSelector).tmpl(tmplData)
                .appendTo(self.helper.getContentBlock());
        });

        request.fail(function (jqXHR, textStatus) {
            console.log('Request failed: ' + textStatus);
        });
    },

    /**
     *
     */
    initWidget: function () {
        var self = this;
        self.processWidget();
        self.interval = setInterval(function () {
            self.processWidget();
        }, 30000);
    },

    /**
     * Init weather widget
     */
    init: function () {
        var self = this;
        self.initWidget();

        // Load widget via AJAX when click on brand link
        self.$j(self.menuLinkSelector).on('click', function (event) {
            event.preventDefault();
            var link = self.$j(this);
            // Not load if page already active
            if (link.parent().hasClass(self.helper.config.linkActiveClass)) return;

            LandingStaticPages.removeOldActiveLink();
            link.parent().addClass(self.helper.config.linkActiveClass);
            // make sure that old interval cleared
            if (self.interval) clearInterval(self.interval);
            self.initWidget();
        });

        // Clear interval when loading CMS paged via AJAX
        var cmsLinks = LandingStaticPages.getLinks();
        cmsLinks.on('click', function () {
            clearInterval(self.interval);
        });
    }
};

jQuery(document).ready(function () {
    var landingStaticPages = LandingStaticPages.init();
    var weather = LandingWeather.init();
});


