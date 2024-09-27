abstract class AbstractApiGateway {

    static objectToQueryParams = (params: { [key: string]: any }) => {
        return new URLSearchParams(params).toString();
    };
}

export default AbstractApiGateway;