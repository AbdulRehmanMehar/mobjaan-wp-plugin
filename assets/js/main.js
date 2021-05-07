$(document).ready(() => {
    $('#review_form').submit(event => {
        event.preventDefault();
        let url = $('#review_form').attr('data-url');

        let data = {
            title: $('[name="review_title_Field"]').val(),
            feedback: $('[name="review_feedback"]').val(),
            price: $('[name="price_rating_review"]').val(),
            quality: $('[name="quality_rating_review"]').val(),
            contact: $('[name="contact_rating_review"]').val(),
            general: $('[name="general_rating_review"]').val(),
            listing: $('[name="listing_id"]').val(),
            author: $('[name="author_id"]').val(),
            action: $('[name="action"]').val(),
        };

        let params = new URLSearchParams(new FormData(document.getElementById('review_form')));

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
    })
})