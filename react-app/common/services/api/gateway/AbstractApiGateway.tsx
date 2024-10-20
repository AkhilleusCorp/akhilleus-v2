import axios from "axios";
import IndexedArray from "app/common/utils/interfaces/IndexedArray.tsx";
import APIResponseDTO from "app/common/services/api/dtos/APIResponseDTO.tsx";
abstract class AbstractApiGateway {

    static async getOne (url: string): Promise<any|null> {
        const response = await axios.get(url);

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        return response.data.data;
    }

    static async getMany (url: string, filters: any|null): Promise<APIResponseDTO> {
        const queryUrl = null == filters ? url : url + "?" + this.objectToQueryParams(filters);
        const response = await axios.get(queryUrl);
        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        return response.data;
    }

    static async getDropdownable (url: string): Promise<IndexedArray> {
        const response = await axios.get(url);

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        return response.data;
    }

    static async createOne (url: string, formData: unknown): Promise<any> {
        const response = await axios.post(url, formData);

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        return response.data.data;
    }

    static async updateOne (url: string, formData: unknown): Promise<any> {
        const response = await axios.put(url, formData);

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        return response.data.data;
    }

    static async deleteOne (url: string): Promise<void> {
        const response = await axios.delete(url);

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }
    }

    static async patchOne (url: string): Promise<any|null> {
        const response = await axios.patch(url);

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        return response.data.data;
    }

    static objectToQueryParams = (params: { [key: string]: any }) => {
        return new URLSearchParams(params).toString();
    };
}

export default AbstractApiGateway;