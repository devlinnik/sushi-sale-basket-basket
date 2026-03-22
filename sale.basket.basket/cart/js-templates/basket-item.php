<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
?>

<style>

    .symbol_ruble{
        font-family:'rubleBitrix',Arial,sans-serif;
    }


    /* CARD */

    .basket-card{

        display:grid;

        grid-template-columns:120px 1fr auto;
        grid-template-rows:auto auto;

        column-gap:25px;
        row-gap:10px;

        padding:25px;

        border:1px solid #F77504;
        border-radius:28px;

        background: #ffffff;

        box-shadow:0 10px 20px rgba(0,0,0,0.08);

        position:relative;
        margin-bottom:20px;
    }


    /* IMAGE */

    .basket-card-image{

        grid-row:1 / span 2;
        display:flex;
        align-items:center;
    }

    .basket-card-image img{

        width:110px;
        height:110px;
        object-fit:contain;
    }


    /* INFO */

    .basket-card-info{

        grid-column:2;
        grid-row:1;
        font-family:'Commissioner';
    }

    .basket-card-title{

        font-size:24px;
        font-weight:700;
        margin-bottom:6px;
    }

    .basket-card-props{

        font-size:16px;
        line-height:1.4;
        margin-bottom:6px;
    }

    .basket-card-props b{

        font-weight:700;
    }


    /* PRICE (скрыт) */

    .basket-card-price{

        display:none;
    }


    /* SUM */

    .basket-card-sum{

        grid-column:3;
        grid-row:3;

        justify-self:end;

        font-size:28px;
        font-weight:700;
        font-family:'Commissioner';
    }


    /* QUANTITY */

    .basket-card-quantity{

        grid-column:3;
        grid-row:2;

        display:flex;
        align-items:center;

        border:2px solid #F77504;
        border-radius:40px;
        padding:4px;

        background:#fff;
    }


    /* BUTTONS */

    .qty-btn{

        width:40px;
        height:40px;

        border-radius:50%;
        border:none;

        font-size:22px;
        font-weight:700;

        background:#fff;
        color:#F77504;

        cursor:pointer;

        display:flex;
        align-items:center;
        justify-content:center;
    }

    .qty-btn.minus{

        background:#F77504;
        color:#fff;
    }

    .qty-btn.plus{

        border:2px solid #F77504;
    }

    .qty-input{

        width:50px;
        text-align:center;

        font-size:24px;
        font-weight:700;

        border:none;
        background:transparent;
    }


    /* REMOVE */

    .basket-card-remove{

        position:absolute;
        top:18px;
        right:18px;

        width:42px;
        height:42px;

        border-radius:50%;

        background:#F77504;
        color:#fff;

        font-size:20px;

        border:none;

        cursor:pointer;

        display:flex;
        align-items:center;
        justify-content:center;

        box-shadow:0 4px 10px rgba(0,0,0,0.2);
    }

    .basket-card-remove:hover{

        background:#d86500;
    }


    /* MOBILE */

    @media(max-width:768px){
        .basket-card-remove {
            right: 5px;
            top: 5px;
        }
        .basket-card{
            grid-template-columns:90px 1fr;
            grid-template-rows:auto auto auto;
            padding: 20px;
            border-radius: 20px;
            column-gap: 30px;
        }

        .basket-card-quantity{

            grid-column:2;
            grid-row:2;
        }

        .basket-card-sum{
            font-size: 21px;
            grid-column:2;
            grid-row:3;
        }
        .basket-card {
            background: #ffffff;
        }
        .basket-card-title a {
            font-size: 21px;
            color: black;
        }
        .basket-card-quantity {
            width: 140px;
            margin-left: 3rem;
        }
        .basket-checkout-block-total {
            font-size: 15px;
        }
        .basket-checkout-block-btn {
            height: 40px;
            width: auto;
            font-size: 15px;
        }
    }
    @media screen and (max-width: 380px) {
        .basket-card{
            column-gap: 15px;
        }
    }
</style>



<script id="basket-item-template" type="text/html">
    <tr id="basket-item-{{ID}}" data-entity="basket-item" data-id="{{ID}}">
        <td colspan="3" style="border:none; padding:0 0 20px 0;">
            <div class="basket-card" id="basket-item-height-aligner-{{ID}}">
                {{#SHOW_LOADING}}
                <div class="basket-items-list-item-overlay"></div>
                {{/SHOW_LOADING}}

                <div class="basket-card-image">
                    {{#DETAIL_PAGE_URL}}<a href="{{DETAIL_PAGE_URL}}">{{/DETAIL_PAGE_URL}}
                        <img
                                src="{{{IMAGE_URL}}}{{^IMAGE_URL}}/bitrix/images/no_photo.png{{/IMAGE_URL}}"
                                alt="{{NAME}}">
                        {{#DETAIL_PAGE_URL}}</a>{{/DETAIL_PAGE_URL}}
                </div>

                <div class="basket-card-info">
                    <div class="basket-card-title">
                        {{#DETAIL_PAGE_URL}}<a href="{{DETAIL_PAGE_URL}}" data-entity="basket-item-name">{{/DETAIL_PAGE_URL}}
                            {{NAME}}
                            {{#DETAIL_PAGE_URL}}</a>{{/DETAIL_PAGE_URL}}
                    </div>

                    <div class="basket-card-props">
                        {{#PROPS}}
                        <div class="basket-prop">
                            <b>{{NAME}}</b>: {{{VALUE}}}
                        </div>
                        {{/PROPS}}
                    </div>
                </div>

                <div class="basket-card-price" style="display:none;">
                    <div id="basket-item-price-{{ID}}">{{{PRICE_FORMATED}}}</div>
                </div>

                <div class="basket-card-quantity" data-entity="basket-item-quantity-block">
                    <button
                            type="button"
                            class="qty-btn minus"
                            data-entity="basket-item-quantity-minus"
                            {{#NOT_AVAILABLE}}disabled="disabled"{{/NOT_AVAILABLE}}>
                    −
                    </button>

                    <input
                            type="text"
                            value="{{QUANTITY}}"
                            data-value="{{QUANTITY}}"
                            data-entity="basket-item-quantity-field"
                            id="basket-item-quantity-{{ID}}"
                            class="qty-input"
                            {{#NOT_AVAILABLE}}disabled="disabled"{{/NOT_AVAILABLE}}>

                    <button
                            type="button"
                            class="qty-btn plus"
                            data-entity="basket-item-quantity-plus"
                            {{#NOT_AVAILABLE}}disabled="disabled"{{/NOT_AVAILABLE}}>
                    +
                    </button>
                </div>

                <div class="basket-card-sum">
                    <div id="basket-item-sum-price-{{ID}}">{{{SUM_PRICE_FORMATED}}}</div>
                </div>

                <button
                        type="button"
                        class="basket-card-remove"
                        data-entity="basket-item-delete">
                    ×
                </button>
            </div>
        </td>
    </tr>
</script>
