import Swal from "sweetalert2";

export default {
    errorMessage(message) {
        return Swal.fire({
            icon: "error",
            title: "Oops",
            text: message,
            confirmButtonText: "Back To Menu",
        });
    },

    deleteConfirmationMessage() {
        return Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        });
    },

    async redirectMessage(response, inertia, routeName) {
        let timerInterval;
        await Swal.fire({
            icon: "success",
            title: response,
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
            html: "Return in <b></b> seconds.",
            didOpen: () => {
                const b = Swal.getHtmlContainer().querySelector("b");
                timerInterval = setInterval(() => {
                    b.textContent = (Swal.getTimerLeft() / 1000).toFixed(0);
                }, 100);
            },
            willClose: () => {
                clearInterval(timerInterval);
            },
        }).then((result) => {
            if (
                result.dismiss === Swal.DismissReason.timer ||
                result.isConfirmed
            ) {
                inertia.visit(route(routeName));
            }
        });
    },
};
