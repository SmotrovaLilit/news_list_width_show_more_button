(function($) {
    $(function() {
        var container_list_selector = '.news-list',
            show_more_selector = '.show-more';

        $('body').on ('click', show_more_selector, function (e) {
            var $container_list_selector = $(container_list_selector),
                $this = $(this),
                path = $this.attr('href');
            $.get(path, function (data) {
                var element = document.createElement('div'),
                    $domElement =  $(element);
                $domElement.html(data);
                $container_list_selector.append($domElement.find(container_list_selector).html());
                var $newShowMore = $domElement.find(show_more_selector);
                if ($domElement.find(show_more_selector).length) {
                    $this.attr('href', $newShowMore.attr('href'));
                } else {
                    $this.hide();
                }
            });

            e.preventDefault();
        });
    });
})(jQuery);