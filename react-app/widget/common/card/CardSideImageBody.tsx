import React, {ReactNode} from 'react';

type CardSideImageBodyType = {
    imageSrc: string;
    imageAlt: string;
    children: ReactNode
}

const CardSideImageBody: React.FC<CardSideImageBodyType> = ({ imageSrc, imageAlt, children }) => {
    return (
        <div className={"card-body"}>
            <div className={"card-image"}>
                <img src={imageSrc} alt={imageAlt}/>
            </div>
            <div className={"card-content"}>
                {children}
            </div>
        </div>
    );
}

export default CardSideImageBody;