
const isUrlParamANumber = ({ params }: any) => {
    const id: string = params.id;
    const isNumeric: boolean = /^\d+$/.test(id);
    if (!isNumeric) {
        throw new Response("Id doit être un nombre.", { status: 400 });
    }
    return true;
}

export default isUrlParamANumber;