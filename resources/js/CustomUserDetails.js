export default function (response) {
    return {
        name: {
            title: "Name",
            data: [
                {
                    title: "name",
                    value: response.data.user.name,
                },
                {
                    title: "email",
                    value: response.data.user.email,
                },
                {
                    title: "created at",
                    value: response.data.user.created_at,
                },
            ],
        },
        biography: {
            title: "Biography",
            data: [
                {
                    title: "gender",
                    value: response.data.user.biography?.gender,
                },
                {
                    title: "home number",
                    value: response.data.user.biography?.home_number,
                },
                {
                    title: "mobile number",
                    value: response.data.user.biography?.mobile_number,
                },
                {
                    title: "birth date",
                    value: response.data.user.biography?.birth_date,
                },
            ],
        },
        address: {
            title: "Address",
            data: [
                {
                    title: "address line one",
                    value: response.data.user.biography?.address_line_one,
                },
                {
                    title: "address line two",
                    value: response.data.user.biography?.address_line_two,
                },
                {
                    title: "city",
                    value: response.data.user.biography?.city,
                },
                {
                    title: "country",
                    value: response.data.user.biography?.country,
                },
                {
                    title: "postcode",
                    value: response.data.user.biography?.postcode,
                },
                {
                    title: "state",
                    value: response.data.user.biography?.state,
                },
            ],
        },
    };
}
