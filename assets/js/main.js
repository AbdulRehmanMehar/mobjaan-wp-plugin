$(document).ready(() => {

    let loader = () => {
        $('body').addClass('loading');
        $('body').html('<div class="spinner large"></div>');
    }

    $('#review_form').submit(event => {
        event.preventDefault();
        let url = $('#review_form').attr('data-url');

        let params = new URLSearchParams(new FormData(document.getElementById('review_form')));
       loader();

        fetch(url, {
            method: 'post',
            body: params,
            headers: {
                'Access-Control-Allow-Origin': '*',
            }
        })
        .then(res => res.json())
        .then(data => {
            console.log(data)
            if (data.status == 'success') {
                alert('Review added Successfully');
            }else {
                alert('Something went wrong. Try again later');
            }
            window.location.reload();
        })
    });



    $('#add_lisitng_modal_form').submit(event => {
        event.preventDefault();
        let url = $('#add_lisitng_modal_form').attr('data-url');
        let content = CKEDITOR.instances['content'].getData();
        
        let params = new FormData(document.getElementById('add_lisitng_modal_form'));
        params.set('content', content)
        loader();
        fetch(url, {
            method: 'post',
            body: params,
            headers: {
                // 'Access-Control-Allow-Origin': '*',
                // 'Content-Type': 'multipart/form-data; boundary=--mboundart',
            }
        })
        // .then(() => )
        .then(res => res.json())
        .then(data => {
            // console.log(data)
            if (data.status == 'success') {
                alert('Listing added Successfully');
            }else {
                alert('Something went wrong. Try again later');
            }
            window.location.reload();
        })
    })


    // MENU JS
    var Menu = {

        body: $('.menu'),
        button: $('.button'),
        tools: $('.tools')

    };

    Menu.button.click(function () {
        Menu.body.toggleClass('menu--closed');
        Menu.body.toggleClass('menu--open');
        Menu.tools.toggleClass('tools--visible');
        Menu.tools.toggleClass('tools--hidden');
    });
})