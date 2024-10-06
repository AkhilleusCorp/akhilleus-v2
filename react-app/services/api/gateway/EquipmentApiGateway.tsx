import axios from "axios";
import AbstractApiGateway from "./AbstractApiGateway.tsx";
import EquipmentDTO from "../dtos/EquipmentDTO.tsx";
import EquipmentsListFilters from "../filters/EquipmentsListFilters.tsx";
import apiRoutes from "../apiRoutes.tsx";
import QueryId from "../../../utils/interfaces/QueryId.tsx";
import IndexedArray from "../../../utils/interfaces/IndexedArray.tsx";

class EquipmentApiGateway extends AbstractApiGateway {
    static async getOneEquipment (equipmentId: QueryId): Promise<EquipmentDTO|null> {
        const response = await axios.get(apiRoutes.equipment.details(equipmentId));

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        return response.data.data;
    }

    static async getManyEquipments (filters: EquipmentsListFilters): Promise<EquipmentDTO[]> {
        const queryParams = this.objectToQueryParams(filters);
        const response = await axios.get(apiRoutes.equipment.list+'?'+queryParams);

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        if (response.data.data === undefined) {
            return [];
        }

        return response.data.data;
    }

    static async getDropdownableEquipments (): Promise<IndexedArray> {
        const response = await axios.get(apiRoutes.equipment.dropdownable);

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        return response.data;
    }

    static async createEquipment (formData: unknown): Promise<EquipmentDTO> {
        const response = await axios.post(
            apiRoutes.equipment.create,
            formData
        );

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        return response.data.data;
    }

    static async updateEquipment (equipmentId: number, formData: unknown): Promise<EquipmentDTO> {
        const response = await axios.put(
            apiRoutes.equipment.update(equipmentId),
            formData
        );

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }

        return response.data.data;
    }

    static async deleteEquipment (equipmentId: QueryId): Promise<void> {
        const response = await axios.delete(apiRoutes.equipment.delete(equipmentId));

        if (response.status !== 200) {
            throw new Error('An error as occurred');
        }
    }
}

export default EquipmentApiGateway;