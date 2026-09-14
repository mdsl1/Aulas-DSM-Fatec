import { Text, View } from 'react-native';
import { styles } from './styles';

type ConceptCardProps = {
    descricao: string,
    icone: string,
    titulo: string,
    wide?: boolean
}

export function ConceptCard({
    descricao, 
    icone, 
    titulo, 
    wide = false
} : ConceptCardProps) {
    return (
        <View style={[styles.cartao, wide && styles.cartaoWide ]}>

            <View style={styles.containerIcone}>
                <Text style={styles.icone}>{icone}</Text>
            </View>
            
            <View>
                <Text style={styles.titulo}>{titulo}</Text>
                <Text style={styles.descricao}>{descricao}</Text>
            </View>
            
        </View>
    );
}