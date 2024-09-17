
const isUrlParamANumber = ({ params }: any) => {
    const id = params.id;
    const isNumeric = /^\d+$/.test(id);
    if (!isNumeric) {
        throw new Response("Id doit être un nombre.", { status: 400 });
    }
    return true;
}

export default isUrlParamANumber;