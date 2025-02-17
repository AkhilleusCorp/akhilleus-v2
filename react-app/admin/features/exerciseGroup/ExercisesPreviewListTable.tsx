import React from "react";
import {Table, TableBody, TableCell, TableContainer, TableHead, TableRow, Typography} from "@mui/material";
import ExerciseDTO from "app/common/services/api/dtos/ExerciseDTO.tsx";
import IndexedArray from "app/common/utils/interfaces/IndexedArray.tsx";
import MovementPropertyDTO from "app/common/services/api/dtos/MovementPropertyDTO.tsx";

type ExercisesPreviewListTable = {
    movementConfigs: IndexedArray;
    exercises: ExerciseDTO[];
}

const ExercisesPreviewListTable: React.FC<ExercisesPreviewListTable> = ({movementConfigs, exercises}) => {
    const movementNames: IndexedArray = {};
    const headers: IndexedArray = {name: 'name'};
    const properties: IndexedArray = {};

    Object.keys(movementConfigs).forEach(movementConfigKey => {
        movementNames[movementConfigKey] = movementConfigs[movementConfigKey].name;

        movementConfigs[movementConfigKey].trackedProperties.forEach((trackedProperty: MovementPropertyDTO) => {
            let header = trackedProperty.name;
            if (null !== trackedProperty.unit) {
                header += " (" + trackedProperty.unit + ")";
            }

            properties[trackedProperty.name] = trackedProperty.name;
            headers[trackedProperty.name] = header;
        });
    });

    if (Object.keys(movementConfigs).length === 1) {
        delete headers['name'];
    }

    return (
        <>
            <Typography variant="h6" component="div">
                { Object.values(movementNames).join(' / ') }
            </Typography>
            <TableContainer>
                <Table>
                    <TableHead>
                        <TableRow>
                            { Object.entries(headers).map(([key, header]) => (
                                <TableCell key={key}>{ header }</TableCell>
                            ))}
                        </TableRow>
                    </TableHead>
                    <TableBody>
                    { exercises.map((exercise: any) => (
                        <TableRow key={exercise.id}>
                            { Object.keys(movementNames).length > 1 && (
                                <TableCell>{movementNames[exercise.movementId]}</TableCell>
                            )}
                            { Object.entries(properties).map(([key, property]) => (
                                <TableCell key={exercise.id + "-" + key}>{ exercise[property] }</TableCell>
                            ))}
                        </TableRow>
                    ))}
                    </TableBody>
                </Table>
            </TableContainer>
        </>
    )
}

export default ExercisesPreviewListTable;