import React from 'react';
import {useNavigate} from "react-router-dom";
import {useState} from "react";
import {FormControl, Grid2 as Grid, SelectChangeEvent, TextField} from "@mui/material";
import EquipmentDTO from "app/admin/services/api/dtos/EquipmentDTO.tsx";
import EquipmentApiGateway from "app/admin/services/api/gateway/EquipmentApiGateway.tsx";
import adminRoutes from "app/admin/services/router/adminRoutes.tsx";
import equipmentRegistries from "app/common/constants/equipmentRegistries.tsx";
import SelectInput from "app/common/components/input/SelectInput.tsx";
import SaveForm from "app/common/components/form/SaveForm.tsx";

type EquipmentUpdateFormType = {
    equipment: EquipmentDTO,
}

const EquipmentUpdateForm: React.FC<EquipmentUpdateFormType> = ({equipment}) => {
    const navigate = useNavigate();
    const [equipmentUpdated, setEquipmentUpdated] = useState<EquipmentDTO>(equipment);

    const handleInputChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        setEquipmentUpdated({
            ...equipmentUpdated,
            [event.target.name]: event.target.value
        });
    }

    const handleSelectChange = (event: SelectChangeEvent) => {
        setEquipmentUpdated({
            ...equipmentUpdated,
            [event.target.name]: event.target.value
        });
    }

    const handleSubmit = async () => {
        try {
            await EquipmentApiGateway.updateEquipment(equipment.id, equipmentUpdated);
            navigate(adminRoutes.equipment.details(equipment.id));
        } catch (error) {
            console.log(error);
        }
    }

    return (
        <SaveForm submitFunction={handleSubmit}>
            <Grid size={{ xs: 4 }}>
                <FormControl fullWidth>
                    <TextField id="outlined-basic" label="Name" variant="outlined" size="small" required={true}
                               name={"name"} value={equipmentUpdated.name} onChange={handleInputChange}/>
                </FormControl>

                <SelectInput label="Status" name={"status"} value={equipmentUpdated.status}
                             options={equipmentRegistries.status} required={true} onSelectChange={handleSelectChange}/>
            </Grid>
        </SaveForm>
    )
}

export default EquipmentUpdateForm;