import React, {ReactNode} from 'react';

type CardSideImageBodyType = {
    imageSrc: string;
    imageAlt: string;
    children: ReactNode
}

const CardSideImageBody: React.FC<CardSideImageBodyType> = ({ imageSrc, imageAlt, children }) => {
    return (
        <div className={"card-body card-body-side-image"}>
            <img src={imageSrc} alt={imageAlt}/>
            <div className={"card-content"}>
                {children}
            </div>
        </div>
    );
}

export default CardSideImageBody;