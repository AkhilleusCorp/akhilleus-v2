import AbstractApiGateway from "./AbstractApiGateway.tsx";
import EquipmentDTO from "../dtos/EquipmentDTO.tsx";
import EquipmentsListFilters from "../filters/EquipmentsListFilters.tsx";
import apiRoutes from "../apiRoutes.tsx";
import QueryId from "../../../utils/interfaces/QueryId.tsx";
import IndexedArray from "../../../utils/interfaces/IndexedArray.tsx";
import axios from "axios";

class EquipmentApiGateway extends AbstractApiGateway {
    static async getOneEquipment (equipmentId: QueryId): Promise<EquipmentDTO|null> {
        return this.getOne(apiRoutes.equipment.details(equipmentId));
    }

    static async getManyEquipments (filters: EquipmentsListFilters): Promise<EquipmentDTO[]> {
        const response = await axios.get(apiRoutes.equipment.list + '?' + this.objectToQueryParams(filters));
        return response.data.data;
    }

    static async getDropdownableEquipments (): Promise<IndexedArray> {
        return this.getDropdownable(apiRoutes.equipment.dropdownable);
    }

    static async createEquipment (formData: unknown): Promise<EquipmentDTO> {
        return this.createOne(apiRoutes.equipment.create, formData);
    }

    static async updateEquipment (equipmentId: number, formData: unknown): Promise<EquipmentDTO> {
        return this.updateOne(apiRoutes.equipment.update(equipmentId), formData);
    }

    static async deleteEquipment (equipmentId: QueryId): Promise<void> {
        return this.deleteOne(apiRoutes.equipment.delete(equipmentId));
    }
}

export default EquipmentApiGateway;