<template>
    <ModalCentered :Title="$t('NewVersion')" ModalName="newVersionModal" ModalTypes="modal-xl"  :isSubmit="false" >
        <div>
            <h5><a href="blog-details.html" class="text-dark">Beautiful Day with Friends</a></h5>
            <p class="text-muted">10 Apr, 2020</p>

            <div class="position-relative mb-3">
                <img src="https://www.formacar.com/storage/images_news/00/18/31/90/B73PAwgD9wjH.jpg" alt="" class="img-thumbnail">
            </div>

            <ul class="list-inline">
                <li class="list-inline-item me-3">
                    <a href="javascript: void(0);" class="text-muted">
                        <i class="bx bx-purchase-tag-alt align-middle text-muted me-1"></i> Project
                    </a>
                </li>
                <li class="list-inline-item me-3">
                    <a href="javascript: void(0);" class="text-muted">
                        <i class="bx bx-comment-dots align-middle text-muted me-1"></i> 12 Comments
                    </a>
                </li>
            </ul>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

            <div>
                <a href="javascript: void(0);" class="text-primary">Read more <i class="mdi mdi-arrow-right"></i></a>
            </div>
        </div>
        <div>
            <h5><a href="blog-details.html" class="text-dark">Beautiful Day with Friends</a></h5>
            <p class="text-muted">10 Apr, 2020</p>

            <div class="position-relative mb-3">
                <img src="https://www.formacar.com/storage/images_news/00/18/31/90/B73PAwgD9wjH.jpg" alt="" class="img-thumbnail">
            </div>

            <ul class="list-inline">
                <li class="list-inline-item me-3">
                    <a href="javascript: void(0);" class="text-muted">
                        <i class="bx bx-purchase-tag-alt align-middle text-muted me-1"></i> Project
                    </a>
                </li>
                <li class="list-inline-item me-3">
                    <a href="javascript: void(0);" class="text-muted">
                        <i class="bx bx-comment-dots align-middle text-muted me-1"></i> 12 Comments
                    </a>
                </li>
            </ul>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>

            <div>
                <a href="javascript: void(0);" class="text-primary">Read more <i class="mdi mdi-arrow-right"></i></a>
            </div>
        </div>
    </ModalCentered>
</template>
<script setup>
import ModalCentered from "@/components/all/ModalCentered.vue";
</script>
