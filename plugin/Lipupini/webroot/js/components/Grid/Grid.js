import van from '/lib/van-1.2.1.min.js'
import { Video } from './FileType/Video.js'
import { Image } from './FileType/Image.js'
import { Audio } from './FileType/Audio.js'

const Grid = ({collectionData}) => {
	collectionData.forEach((item) => {
		switch (item.filename.slice((item.filename.lastIndexOf(".") - 1 >>> 0) + 2)) {
			case 'jpg':
			case 'png':
				van.add(document.getElementById('media-container'), Image(item))
				break
			case 'mp4':
				van.add(document.getElementById('media-container'), Video(item))
				break
			case 'mp3':
				van.add(document.getElementById('media-container'), Audio(item))
				break
			default:
				throw new Error('Unknown file extension')
		}
	})
}

Grid({ collectionData })
