import React from 'react';
import {useNavigate} from "react-router-dom";
import {useState} from "react";
import websiteRoutes from "../../setup/router/websiteRoutes.tsx";
import SaveForm from "../../components/form/SaveForm.tsx";
import EquipmentApiGateway from "../../services/api/gateway/EquipmentApiGateway.tsx";
import EquipmentDTO from "../../services/api/dtos/EquipmentDTO.tsx";
import {FormControl, Grid2 as Grid, SelectChangeEvent, TextField} from "@mui/material";
import SelectInput from "../../components/input/SelectInput.tsx";
import equipmentRegistries from "../../constants/equipmentRegistries.tsx";

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
            navigate(websiteRoutes.equipment.details(equipment.id));
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