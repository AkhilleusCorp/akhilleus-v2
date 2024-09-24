abstract class AbstractAPI {

    static objectToQueryParams = (params: { [key: string]: any }) => {
        return new URLSearchParams(params).toString();
    };
}